export const useApi = () => {
  const baseURL = '/api'
  const $fetchApi = (path: string, opts: any = {}) =>
    $fetch(baseURL + path, { ...opts })

  return { $fetchApi }
}
