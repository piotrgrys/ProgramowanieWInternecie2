import React from 'react'
import { Container, Nav, Navbar } from 'react-bootstrap'
import { Outlet } from 'react-router'
import { NavLink } from 'react-router-dom'

const Layout = () => {
    return (
        <>
            <Navbar bg="light" expand="lg">
                <Container>
                    <Navbar.Brand to="/" as={NavLink}>
                        PI2
                    </Navbar.Brand>
                    <Navbar.Toggle aria-controls="basic-navbar-nav" />
                    <Navbar.Collapse id="basic-navbar-nav">
                        <Nav className="me-auto">
                            <Nav.Link to="/" as={NavLink}>
                                Movies
                            </Nav.Link>
                            <Nav.Link to="/add" as={NavLink}>
                                Add a movie
                            </Nav.Link>
                            <Nav.Link to="/genrelist" as={NavLink}>
                                Genres
                            </Nav.Link>
                            <Nav.Link to="/addgenre" as={NavLink}>
                                Add a genre
                            </Nav.Link>
                        </Nav>
                    </Navbar.Collapse>
                </Container>
            </Navbar>

            <Container className="pt-4">
                <Outlet />
            </Container>
        </>
    )
}

export default Layout
