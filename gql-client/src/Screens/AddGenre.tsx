import React from 'react'
import { ADD_GENRE, IGenre } from '../api/queries'
import GenreForm from '../Components/GenreForm'

const AddGenre = () => {
    const initialValues: IGenre = {
        id: 0,
        name: ''
    }
    return <GenreForm initialValues={initialValues} query={ADD_GENRE} />
}

export default AddGenre
