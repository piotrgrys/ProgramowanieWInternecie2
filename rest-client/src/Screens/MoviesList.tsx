import React from 'react'
import { Col, Row } from 'react-bootstrap'
import { useQuery } from '@tanstack/react-query'
import { fetchMovies, IMovie } from '../api/movies'
import Movie from '../Components/Movie'
import { fetchGenre } from '../api/genres'

const MoviesList = () => {
    const { isLoading, data } = useQuery(['movies'], fetchMovies)
    const iitem= (movie:IMovie)=>
{
    return (<Movie movie={movie}/>);
}
    if (isLoading) return <div>Loading...</div>

    return (
        <Row xs={1} md={3} className="pt-2">
            {data?.map((m) => (
                <Col key={m.id} className="mb-2">
                    {iitem(m)}
                </Col>
            ))}
        </Row>
    )
}

export default MoviesList
