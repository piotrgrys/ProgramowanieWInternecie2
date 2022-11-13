import { Badge, Button, Card } from 'react-bootstrap'
import { Link } from 'react-router-dom'
import { IGenre } from '../api/queries'

type Props = {
    genre: IGenre
}

const Genre = ({ genre }: Props) => {
    return (
        <Card>
            <Card.Body>
                <Card.Title>
                    {genre.name}{' '}
                </Card.Title>
                <Card.Link
                    as={Link}
                    to={`/editgenre/${genre.id}`}
                    className="btn btn-sm btn-secondary"
                >
                    Edit
                </Card.Link>
            </Card.Body>
        </Card>
    )
}

export default Genre
