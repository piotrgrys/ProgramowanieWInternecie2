import { useQuery } from '@apollo/client'
import React from 'react'
import { Col, Row } from 'react-bootstrap'
import { FETCH_MOVIES, IFetchMoviesData } from '../api/queries'
import Movie from '../Components/Movie'

const MoviesList = () => {
    const { loading, data } = useQuery<IFetchMoviesData>(FETCH_MOVIES)

    if (loading) return <div>Loading...</div>

    return (
        <Row xs={1} md={3} className="pt-2">
            {data?.movies.map((m) => (
                <Col key={m.id} className="mb-2">
                    <Movie movie={m} />
                </Col>
            ))}
        </Row>
    )
}

export default MoviesList
