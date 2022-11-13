import api from './client'

export interface IGenre {
    id: number,
    name: string
}

const genres = [
        {id: 1, name: 'Drama'},
        {id: 2, name: 'Crime'},
        {id: 3, name: 'Action'},
    ]


export async function fetchGenres(): Promise<IGenre[]> {
    const resp = await api.get('/genres')
    
    return resp.data['_embedded'].genres as IGenre[]
}
export async function fetchGenre(id: number): Promise<IGenre | undefined> {
    const resp = await api.get(`/genres/${id}`)
    return resp.data;
}