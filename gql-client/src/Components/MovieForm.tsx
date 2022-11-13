import React, { useState } from 'react'
import { useFormik } from 'formik'
import { FETCH_GENRES, IFetchGenresData, IGenre, IMovie } from '../api/queries'
import { useNavigate } from 'react-router'
import { Form, Button, Alert } from 'react-bootstrap'
import { useMutation, useQuery } from '@apollo/client'
import { DocumentNode } from 'graphql'

type Props = {
    initialValues: IMovie
    query: DocumentNode
}

const MovieForm = ({ initialValues, query }: Props) => {
    const [error, setError] = useState('')
    const navigate = useNavigate()
    const [save, { loading }] = useMutation<IMovie, IMovie>(query)

    const formik = useFormik<IMovie>({
        initialValues,
        onSubmit: async (values) => {
            setError('')
            const resp = await save({
                variables: values,
                onError: (err) => {
                    setError(err.message)
                },
                refetchQueries: ['FetchMovies'],
            })

            if (resp.data) navigate('/')
        },
    })

    //const genres: IGenre[] = [
    //    { id: 1, name: 'Drama' },
    //    { id: 2, name: 'Crime' },
   //     { id: 3, name: 'Action' },
   // ]
    const { data } = useQuery<IFetchGenresData>(FETCH_GENRES);
    //const { loading, data } = useQuery<IFetchMoviesData>(FETCH_MOVIES)

    return (
        <Form onSubmit={formik.handleSubmit}>
            {error && (
                <Alert variant="danger" className="mb-5">
                    {error}
                </Alert>
            )}

            <Form.Group className="mb-3">
                <Form.Label>Title</Form.Label>
                <Form.Control
                    name="title"
                    onChange={formik.handleChange}
                    value={formik.values.title}
                />
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Year</Form.Label>
                <Form.Control
                    name="year"
                    onChange={formik.handleChange}
                    value={formik.values.year}
                />
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Rating</Form.Label>
                <Form.Control
                    name="rating"
                    onChange={formik.handleChange}
                    value={formik.values.rating}
                />
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Link</Form.Label>
                <Form.Control
                    name="link"
                    onChange={formik.handleChange}
                    value={formik.values.link}
                />
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Genre</Form.Label>
                <Form.Select
                    name="genre_id"
                    onChange={formik.handleChange}
                    value={formik.values.genre_id}
                >
                    <option>-</option>
                    {data?.genres?.map((g) => (
                        <option value={g.id} key={g.id}>
                            {g.name}
                        </option>
                    ))}
                </Form.Select>
            </Form.Group>
            <Form.Group className="mb-3">
                <Form.Label>Watched</Form.Label>
                <Form.Check
                    name="watched"
                    onChange={formik.handleChange}
                    checked={formik.values.watched}
                />
            </Form.Group>
            <Button variant="primary" type="submit" disabled={loading}>
                Save
            </Button>
        </Form>
    )
}

export default MovieForm
