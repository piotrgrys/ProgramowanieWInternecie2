import React from 'react'
import { useQuery } from '@tanstack/react-query'
import { useParams } from 'react-router'
import { editMovie, fetchMovie } from '../api/movies'
import MovieForm from '../Components/MovieForm'

const EditMovie = () => {
    const params = useParams()
    const id = parseInt(params.id!)

    const { isLoading, data } = useQuery(['movies', id], () => fetchMovie(id))

    if (isLoading) return <div>Loading...</div>

    return <MovieForm initialValues={data!} save={editMovie} />
}

export default EditMovie
