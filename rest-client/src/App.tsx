import React from 'react'
import { BrowserRouter, Routes, Route } from 'react-router-dom'
import Layout from './Components/Layout'
import AddMovie from './Screens/AddMovie'
import MoviesList from './Screens/MoviesList'
import EditMovie from './Screens/EditMovie'
import 'bootstrap/dist/css/bootstrap.min.css'
import { QueryClient, QueryClientProvider } from '@tanstack/react-query'
import { ReactQueryDevtools } from '@tanstack/react-query-devtools'

const queryClient = new QueryClient()

function App() {
    return (
        <QueryClientProvider client={queryClient}>
            <BrowserRouter>
                <Routes>
                    <Route path="/" element={<Layout />}>
                        <Route index element={<MoviesList />} />
                        <Route path="add" element={<AddMovie />} />
                        <Route path="edit/:id" element={<EditMovie />} />
                    </Route>
                </Routes>
            </BrowserRouter>
            <ReactQueryDevtools initialIsOpen={false} />
        </QueryClientProvider>
    )
}

export default App
