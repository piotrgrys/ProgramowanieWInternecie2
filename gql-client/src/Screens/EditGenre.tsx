import { useQuery } from '@apollo/client'
import React from 'react'
import { useParams } from 'react-router'
import { EDIT_GENRE, FETCH_GENRE, IFetchGenreData } from '../api/queries'
import GenreForm from '../Components/GenreForm'

const EditGenre = () => {
    const params = useParams()
    const id = parseInt(params.id!)

    const { loading, data } = useQuery<IFetchGenreData>(FETCH_GENRE, {
        variables: { id },
    })

    if (loading) return <div>Loading...</div>

    return <GenreForm initialValues={data!.genres_by_pk} query={EDIT_GENRE} />
}

export default EditGenre
