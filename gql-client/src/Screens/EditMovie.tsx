import { useQuery } from '@apollo/client'
import React from 'react'
import { useParams } from 'react-router'
import { EDIT_MOVIE, FETCH_MOVIE, IFetchMovieData } from '../api/queries'
import MovieForm from '../Components/MovieForm'

const EditMovie = () => {
    const params = useParams()
    const id = parseInt(params.id!)

    const { loading, data } = useQuery<IFetchMovieData>(FETCH_MOVIE, {
        variables: { id },
    })

    if (loading) return <div>Loading...</div>

    return <MovieForm initialValues={data!.movies_by_pk} query={EDIT_MOVIE} />
}

export default EditMovie
