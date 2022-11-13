import { useMutation } from '@apollo/client'
import React, { useState } from 'react'
import { Badge, Button, Card } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import { SET_WATCHED_MOVIE, IMovie } from '../api/queries'

type Props = {
    movie: IMovie
}

const Movie = ({ movie }: Props) => {
    const [error, setError] = useState('')
    const [save, { loading }] = useMutation<IMovie, IMovie>(SET_WATCHED_MOVIE);
    const setWatched = async (values:IMovie) => {
        setError('')
        const resp = await save({
            variables: values,
            onError: (err) => {
                setError(err.message)
            },
            refetchQueries: ['FetchMovies'],
        })
    }
    return (
        <Card>
            <Card.Body>
                <Card.Title>
                    {movie.title}{' '}
                    <small className="text-secondary">({movie.year})</small>
                </Card.Title>
                <Card.Text>
                    <Badge bg="primary">{movie.genre?.name}</Badge>{' '}
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
                <div>

                {
                    movie.watched?
                    'Już objerzano':
                    <Button variant="primary" onClick={()=>setWatched(movie)}
                >
                   Ustaw Obejrzano
                </Button>
                }
                </div>
            </Card.Body>
        </Card>
    )
}

export default Movie
