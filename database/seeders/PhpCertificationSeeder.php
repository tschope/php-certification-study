<?php

namespace Database\Seeders;

use App\Models\Option;
use App\Models\Question;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PhpCertificationSeeder extends Seeder
{
    /**
     * Path to the consolidated markdown file.
     */
    private string $sourcePath;

    public function __construct()
    {
        $this->sourcePath = base_path('database/seeders/resources/php_certification_all_60.md');
    }

    public function run(): void
    {
        if (! File::exists($this->sourcePath)) {
            $this->command->error("Markdown file not found at: {$this->sourcePath}");
            $this->command->warn('Place php_certification_all_60.md under database/seeders/resources/');
            return;
        }

        $raw = File::get($this->sourcePath);

        // Split into sections by "## Question {number}"
        $sections = $this->splitIntoQuestions($raw);

        foreach ($sections as $qNumber => $section) {
            [$bodyMd, $codeSnippet] = $this->extractBodyAndFirstCode($section);
            $alternatives = $this->extractAlternatives($section);
            $answerLetters = $this->extractAnswerLetters($section);

            // Determine multi-answer
            $isMulti = count($answerLetters) > 1;

            $question = Question::create([
                'title'            => "Question {$qNumber}",
                'body_md'          => trim($bodyMd),
                'code_snippet'     => $codeSnippet,
                'multiple_correct' => $isMulti,
                'explanation_md'   => $this->extractExplanation($section),
                'difficulty'       => null,
                'category'         => null,
                'source'           => 'PHP Certification (Markdown import)',
            ]);

            // Create options
            $position = 1;
            foreach ($alternatives as $label => $text) {
                Option::create([
                    'question_id'  => $question->id,
                    'label'        => $label,
                    'text_md'      => $text,
                    'code_snippet' => null,
                    'is_correct'   => in_array(strtolower($label), $answerLetters, true),
                    'position'     => $position++,
                ]);
            }
        }

        $this->command->info('PHP Certification questions imported successfully.');
    }

    /**
     * Split the file into question sections keyed by the question number.
     */
    private function splitIntoQuestions(string $raw): array
    {
        $out = [];
        $pattern = '/^\s*##\s*Question\s+(\d+)\s*$(.*?)(?=^\s*##\s*Question\s+\d+\s*$|\z)/ims';
        if (preg_match_all($pattern, $raw, $m, PREG_SET_ORDER)) {
            foreach ($m as $match) {
                $num = (int) $match[1];
                $block = trim($match[2]);
                $out[$num] = $block;
            }
        }
        ksort($out);
        return $out;
    }

    /**
     * Extract body markdown up to "**Alternatives:**" and the first fenced code block.
     */
    private function extractBodyAndFirstCode(string $section): array
    {
        $body = $section;
        $code = null;

        // First code fence
        if (preg_match('/```[a-zA-Z]*\R(.*?)```/s', $section, $cm)) {
            $code = trim($cm[1]);
        }

        // Cut body at Alternatives:
        if (preg_match('/^(.*?)(?:^\*\*Alternatives:\*\*.*$)/ims', $section, $bm)) {
            $body = trim($bm[1]);
        }

        // Also strip the **Alternatives:** label itself if it sneaks in
        $body = preg_replace('/^\*\*Alternatives:\*\*.*$/im', '', $body);

        return [$body, $code];
    }

    /**
     * Extract alternatives like "a) ..." lines into ['a' => '...', 'b' => '...', ...].
     */
    private function extractAlternatives(string $section): array
    {
        $alts = [];

        // Narrow to Alternatives block if possible
        $block = $section;
        if (preg_match('/^\*\*Alternatives:\*\*\s*(.*?)(?=^\-\-\-|^\*\*Answer:\*\*|\z)/ims', $section, $am)) {
            $block = $am[1];
        }

        // Match lines that start with a letter + ")"
        // Accept optional bullets and spaces
        $pattern = '/^[\-\*\s]*([a-z])\)\s*(.+?)\s*$/im';
        if (preg_match_all($pattern, $block, $m, PREG_SET_ORDER)) {
            foreach ($m as $row) {
                $label = strtolower(trim($row[1]));
                $text  = trim($row[2]);
                $alts[$label] = $text;
            }
        }

        return $alts;
    }

    /**
     * Extract correct answer letters from "**Answer:**" line.
     * Supports: "a)", "a) and d)", "a) & d)", "a) , d)", etc.
     */
    private function extractAnswerLetters(string $section): array
    {
        $letters = [];

        if (preg_match('/^\*\*Answer:\*\*.*$/im', $section, $am)) {
            $answerLine = $am[0];

            // Pick all letters a-e that appear in the answer line
            if (preg_match_all('/\b([a-e])\b/i', $answerLine, $lm)) {
                foreach ($lm[1] as $ch) {
                    $letters[] = strtolower($ch);
                }
            }
        }

        // De-duplicate while keeping order
        $letters = array_values(array_unique($letters));

        return $letters;
    }

    /**
     * Extract an explanation block if you keep one after the Answer line.
     * For now, we leave it empty. You can extend this by capturing text after Answer.
     */
    private function extractExplanation(string $section): ?string
    {
        // If your markdown includes explicit rationales after Answer,
        // implement a capture here. Returning null for now.
        return null;
    }
}
