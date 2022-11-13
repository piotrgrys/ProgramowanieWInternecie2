import { useQuery } from '@apollo/client'
import React from 'react'
import { Col, Row } from 'react-bootstrap'
import { FETCH_GENRES, IFetchGenresData } from '../api/queries'
import Genre from '../Components/Genre'

const GenresList = () => {
    const { loading, data } = useQuery<IFetchGenresData>(FETCH_GENRES)

    if (loading) return <div>Loading...</div>

    return (
        <Row xs={1} md={3} className="pt-2">
            {data?.genres.map((m) => (
                <Col key={m.id} className="mb-2">
                    <Genre genre={m} />
                </Col>
            ))}
        </Row>
    )
}

export default GenresList
