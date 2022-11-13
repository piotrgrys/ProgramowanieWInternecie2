import api from './client'

export interface IMovie {
    id?: number,
    title: string,
    year: number | '',
    rating: number | '',
    link: string,
    genre_id: number
    _links?: any
}

export async function fetchMovies(): Promise<IMovie[]> {
    const resp = await api.get('/movies')
    
    return resp.data['_embedded'].movies as IMovie[]
}

export async function fetchMovie(id: number): Promise<IMovie> {
    const resp = await api.get(`/movies/${id}`)
    
    return resp.data
}

export async function addMovie(movie: IMovie) {
    await api.post('/movies', movie)
}

export async function editMovie(movie: IMovie) {
    const id = movie.id
    delete movie['_links']
    delete movie['id']
    await api.patch(`/movies/${id}`, movie)
}