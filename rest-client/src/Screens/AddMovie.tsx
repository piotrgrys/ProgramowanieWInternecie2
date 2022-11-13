import React from 'react'
import { addMovie, IMovie } from '../api/movies'
import MovieForm from '../Components/MovieForm'

const AddMovie = () => {
    const initialValues: IMovie = {
        id: 0,
        title: '',
        link: '',
        year: '',
        rating: '',
        genre_id: 0,
    }
    return <MovieForm initialValues={initialValues} save={addMovie} />
}

export default AddMovie
