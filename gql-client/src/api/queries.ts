import gql from 'graphql-tag'

export interface IMovie {
    id?: number,
    title: string,
    year: number | '',
    rating: number | '',
    link: string,
    genre_id?: number
    genre?: IGenre
    watched:boolean
}

export interface IGenre {
    id: number
    name: string
}

export interface IFetchMoviesData {
    movies: IMovie[]
}

export interface IFetchMovieData {
    movies_by_pk: IMovie
}

export interface IFetchGenresData {
    genres: IGenre[]
}

export interface IFetchGenreData {
    genres_by_pk: IGenre
}

export const FETCH_MOVIES = gql`
    query FetchMovies {
        movies {
            id
            link
            rating
            title
            year
            genre {
                name
                id
            }
            watched
        }
    }
`
export const FETCH_MOVIE = gql`
    query FetchMovie($id: Int!) {
        movies_by_pk(id: $id) {
            genre_id
            id
            link
            rating
            title
            year
            watched
        }
    }
`

export const ADD_MOVIE = gql`
    mutation AddMovie($title: String, $year: Int, $rating: numeric, $genre_id: Int, $link: String,$watched:Boolean) {
        insert_movies_one(object: {title: $title, year: $year, rating: $rating, link: $link, genre_id: $genre_id,watched:$watched}) {
            id
        }
    }
`

export const EDIT_MOVIE = gql`
    mutation EditMovie($id: Int!, $title: String, $year: Int, $rating: numeric, $link: String, $genre_id: Int,$watched:Boolean) {
        update_movies_by_pk(pk_columns: {id: $id}, _set: {title: $title, year: $year, rating: $rating, link: $link, genre_id: $genre_id,watched:$watched}) {
            id
        }
    }
`

export const FETCH_GENRES = gql`
    query FetchGenres {
        genres {
        id
        name
        }
    }
`

export const FETCH_GENRE = gql`
    query FetchGenre($id: Int!) {
        genres_by_pk(id: $id) {
            id
            name
        }
    }
`
export const SET_WATCHED_MOVIE = gql`
    mutation EditMovie($id: Int!) {
        update_movies_by_pk(pk_columns: {id: $id}, _set: {watched:true}) {
            id
        }
    }
`
export const ADD_GENRE = gql`
    mutation AddGenre($name: String) {
        insert_genres_one(object: {name: $name}) {
            id
        }
    }
`

export const EDIT_GENRE = gql`
    mutation EditGenre($id: Int!, $name: String) {
        update_genres_by_pk(pk_columns: {id: $id}, _set: {name: $name}) {
            id
        }
    }
`