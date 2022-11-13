import React, { useState } from 'react'
import { useFormik } from 'formik'
import { FETCH_GENRES, IFetchGenresData, IGenre, IMovie } from '../api/queries'
import { useNavigate } from 'react-router'
import { Form, Button, Alert } from 'react-bootstrap'
import { useMutation, useQuery } from '@apollo/client'
import { DocumentNode } from 'graphql'

type Props = {
    initialValues: IGenre
    query: DocumentNode
}

const GenreForm = ({ initialValues, query }: Props) => {
    const [error, setError] = useState('')
    const navigate = useNavigate()
    const [save, { loading }] = useMutation<IGenre, IGenre>(query)

    const formik = useFormik<IGenre>({
        initialValues,
        onSubmit: async (values) => {
            setError('')
            const resp = await save({
                variables: values,
                onError: (err) => {
                    setError(err.message)
                },
                refetchQueries: ['FetchGenres'],
            })

            if (resp.data) navigate('/genrelist')
        },
    })

    return (
        <Form onSubmit={formik.handleSubmit}>
            {error && (
                <Alert variant="danger" className="mb-5">
                    {error}
                </Alert>
            )}

            <Form.Group className="mb-3">
                <Form.Label>Name</Form.Label>
                <Form.Control
                    name="name"
                    onChange={formik.handleChange}
                    value={formik.values.name}
                />
            </Form.Group>
            <Button variant="primary" type="submit" disabled={loading}>
                Save
            </Button>
        </Form>
    )
}

export default GenreForm
