export function getErrorsFromResponse(error: any): {[key: string]: string} {
    const errors: any = {}
    
    const messages = Object.entries(error.response.data.validation_messages)
    
    messages.forEach(
        (m: any) => (errors[m[0]] = Object.values(m[1]).join(', '))
    )

    return errors
}