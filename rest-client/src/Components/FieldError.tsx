import React from 'react'
import { Form } from 'react-bootstrap'

type Props = {
    error: string
}

const FieldError = ({ error }: Props) => {
    return <Form.Control.Feedback type="invalid">{error}</Form.Control.Feedback>
}

export default FieldError
