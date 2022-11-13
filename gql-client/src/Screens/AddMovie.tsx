import React from 'react'
import { ADD_MOVIE, IMovie } from '../api/queries'
import MovieForm from '../Components/MovieForm'

const AddMovie = () => {
    const initialValues: IMovie = {
        id: 0,
        title: '',
        link: '',
        year: '',
        rating: '',
        genre_id: 0,
        watched:false
    }
    return <MovieForm initialValues={initialValues} query={ADD_MOVIE} />
}

export default AddMovie
