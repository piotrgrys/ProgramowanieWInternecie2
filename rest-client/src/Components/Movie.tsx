import { useQuery } from '@tanstack/react-query'
import React, { useState } from 'react'
import { Badge, Card } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import { fetchGenre, IGenre } from '../api/genres'
import { IMovie } from '../api/movies'

type Props = {
    movie: IMovie
}

const Movie = ({ movie }: Props) => {

    const { isLoading, data } = useQuery(['genres', movie.genre_id], () => fetchGenre(movie.genre_id))
    return (
        <Card>
            <Card.Body>
                <Card.Title>
                    {movie.title}{' '}
                    <small className="text-secondary">({movie.year})</small>
                </Card.Title>
                <Card.Text>
                    <Badge bg="primary">
                        {data?.name}
                    </Badge>{' '}
                    <Badge bg="warning">★ {movie.rating}</Badge>
                </Card.Text>
                <Card.Link
                    as={Link}
                    to={`/edit/${movie.id}`}
                    className="btn btn-sm btn-secondary"
                >
                    Edit
                </Card.Link>
                <Card.Link href={movie.link} target="_blank">
                    Visit IMDb
                </Card.Link>
            </Card.Body>
        </Card>
    )
}

export default Movie
