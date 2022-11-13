import React from 'react'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import { ApolloClient, InMemoryCache, ApolloProvider } from '@apollo/client'
import Layout from './Components/Layout'
import AddMovie from './Screens/AddMovie'
import MoviesList from './Screens/MoviesList'
import EditMovie from './Screens/EditMovie'
import 'bootstrap/dist/css/bootstrap.min.css'
import GenresList from './Screens/GenresList'
import EditGenre from './Screens/EditGenre'
import AddGenre from './Screens/AddGenre'

const client = new ApolloClient({
    uri: 'http://172.23.32.1:8080/v1/graphql', // docker
    // uri: import.meta.env.VITE_HASURA_ENDPOINT, // hasura cloud
    cache: new InMemoryCache(),
    // headers: {
    //     'x-hasura-admin-secret': import.meta.env.VITE_HASURA_SECRET,
    // },
})

function App() {
    return (
        <ApolloProvider client={client}>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Layout />}>
                        <Route index element={<MoviesList />} />
                        <Route path="add" element={<AddMovie />} />
                        <Route path="edit/:id" element={<EditMovie />} />
                        <Route path="genrelist" element={<GenresList />} />
                        <Route path="editgenre/:id" element={<EditGenre />} />
                        <Route path="addgenre" element={<AddGenre />} />
                    </Route>
                </Routes>
            </BrowserRouter>
        </ApolloProvider>
    )
}

export default App
