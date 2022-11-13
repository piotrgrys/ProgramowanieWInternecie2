import React, { useState } from 'react'
import { useFormik } from 'formik'
import { fetchGenres } from '../api/genres'
import { useMutation, useQuery, useQueryClient } from '@tanstack/react-query'
import { IMovie } from '../api/movies'
import { getErrorsFromResponse } from '../api/errors'
import FieldError from './FieldError'
import { useNavigate } from 'react-router'
import { Form, Button } from 'react-bootstrap'

type Props = {
    initialValues: IMovie
    save: (movie: IMovie) => Promise<void>
}

const MovieForm = ({ initialValues, save }: Props) => {
    const [errors, setErrors] = useState<{ [field in keyof IMovie]?: string }>(
        {}
    )
    const queryClient = useQueryClient()
    const navigate = useNavigate()

    const mutation = useMutation((movie: IMovie) => save(movie), {
        onError(error) {
            setErrors(getErrorsFromResponse(error))
        },
        onSuccess() {
            queryClient.invalidateQueries(['movies'])
            navigate('/')
        },
    })

    const formik = useFormik<IMovie>({
        initialValues,
        onSubmit: (values) => {
            mutation.mutate(values)
        },
    })

    const { isLoading, data } = useQuery(['genres'], fetchGenres);

    return (
        <Form onSubmit={formik.handleSubmit}>
            <Form.Group className="mb-3">
                <Form.Label>Title</Form.Label>
                <Form.Control
                    name="title"
                    onChange={formik.handleChange}
                    value={formik.values.title}
                    className={errors.title ? 'is-invalid' : ''}
                />
                {errors.title && <FieldError error={errors.title} />}
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Year</Form.Label>
                <Form.Control
                    name="year"
                    onChange={formik.handleChange}
                    value={formik.values.year}
                    className={errors.year ? 'is-invalid' : ''}
                />
                {errors.year && <FieldError error={errors.year} />}
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Rating</Form.Label>
                <Form.Control
                    name="rating"
                    onChange={formik.handleChange}
                    value={formik.values.rating}
                    className={errors.rating ? 'is-invalid' : ''}
                />
                {errors.rating && <FieldError error={errors.rating} />}
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Link</Form.Label>
                <Form.Control
                    name="link"
                    onChange={formik.handleChange}
                    value={formik.values.link}
                    className={errors.link ? 'is-invalid' : ''}
                />
                {errors.link && <FieldError error={errors.link} />}
            </Form.Group>

            <Form.Group className="mb-3">
                <Form.Label>Genre</Form.Label>
                <Form.Select
                    name="genre_id"
                    onChange={formik.handleChange}
                    value={formik.values.genre_id}
                    className={errors.genre_id ? 'is-invalid' : ''}
                >
                    <option>-</option>
                    {data?.map((g) => (
                        <option value={g.id} key={g.id}>
                            {g.name}
                        </option>
                    ))}
                </Form.Select>
                {errors.genre_id && <FieldError error={errors.genre_id} />}
            </Form.Group>

            <Button
                variant="primary"
                type="submit"
                disabled={mutation.isLoading}
            >
                Save
            </Button>
        </Form>
    )
}

export default MovieForm
