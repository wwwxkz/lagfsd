import React, { useState, useEffect } from 'react';
import ReactDOM from 'react-dom/client';
import axios from 'axios';

const Main = () => {
    const [updateProducts, setUpdateProducts] = useState(true);
    const [form, setForm] = useState({
        name: '',
        location: '',
        quantity: '',
        price: '',
        description: ''
    });

    const [products, setProducts] = useState([]);

    useEffect(() => {
        getProducts();
    }, [updateProducts]);

    const getProducts = async () => {
        try {
            const response = await axios.get('/api/product');
            setProducts(response.data);
        } catch (error) {
            console.error(error);
        }
    };

    const handleSubmit = (e) => {
        e.preventDefault();
        axios.post('/api/product', form)
            .then((response) => {
                console.log(response.data);
                setUpdateProducts(!updateProducts);
                document.getElementsByClassName("btn-close")[0].click();
            })
            .catch((error) => {
                console.log(error);
            });
        setForm({
            name: '',
            location: '',
            quantity: '',
            price: '',
            description: ''
        });
    }

    const deleteProduct = (id) => {
        axios.delete(`/api/product/${id}`)
            .then((response) => {
                console.log(response);
                setUpdateProducts(!updateProducts);
            })
            .catch((error) => {
                console.log(error);
            })
    }

    return (
        <div className="container">
            <div className="row justify-content-center">
                <div className="col-md-7">
                    <div class="modal fade" id="addProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div className="modal-header">
                                    Add product
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div className="modal-body">
                                    <form onSubmit={handleSubmit}>
                                        <div class="d-flex flex-column">
                                            <label for="name">Name</label>
                                            <input
                                                value={form.name}
                                                id="name"
                                                type="text"
                                                placeholder="Bottle"
                                                onChange={(e) =>
                                                    setForm({ ...form, name: e.target.value })
                                                }
                                            />
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="location">Location</label>
                                            <input
                                                value={form.location}
                                                id="location"
                                                type="text"
                                                placeholder="47.528569, 21.608088"
                                                onChange={(e) =>
                                                    setForm({ ...form, location: e.target.value })
                                                }
                                            />
                                            <p class="text-secondary mb-0">Enter your Latitude/Longitude as text.</p>
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="quantity">Quantity</label>
                                            <input
                                                value={form.quantity}
                                                id="quantity"
                                                type="text"
                                                placeholder="228"
                                                onChange={(e) =>
                                                    setForm({ ...form, quantity: e.target.value })
                                                }
                                            />
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="price">Price</label>
                                            <input
                                                value={form.price}
                                                id="price"
                                                type="text"
                                                placeholder="41.99"
                                                onChange={(e) =>
                                                    setForm({ ...form, price: e.target.value })
                                                }
                                            />
                                        </div>
                                        <div class="d-flex flex-column">
                                            <label for="description">Description</label>
                                            <input
                                                value={form.description}
                                                id="description"
                                                type="text"
                                                placeholder="Water bottle"
                                                onChange={(e) =>
                                                    setForm({ ...form, description: e.target.value })
                                                }
                                            />
                                        </div>
                                        <div class="d-flex flex-column mt-3">
                                            <button class="btn btn-primary" type="submit">
                                                Add
                                            </button>
                                            <a class="text-danger">
                                                Is everything right?
                                            </a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div className="card">
                        <div className="card-header d-flex justify-content-between align-items-center">
                            Products
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addProductModal">
                                Add product
                            </button>
                        </div>
                        <div className="card-body d-flex flex-row flex-wrap justify-content-between">
                            {products.map((product, index) => {
                                return (
                                    <div key={index}>
                                        <h6>Name: {product.name}</h6>
                                        <h6>Location: {product.location}</h6>
                                        <h6>Quantity: {product.quantity}</h6>
                                        <h6>Price: {product.price}</h6>
                                        <h6>Description: {product.description}</h6>
                                        <div className="d-flex flex-column gap-2">
                                            <input className="btn btn-primary" value="Edit" />
                                            <input className="btn btn-danger" value="Delete" onClick={() => {deleteProduct(product.id)} }/>
                                        </div>
                                        <hr />
                                    </div>
                                );
                            })}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
}

export default Main;

if (document.getElementById('main')) {
    const Index = ReactDOM.createRoot(document.getElementById("main"));

    Index.render(
        <React.StrictMode>
            <Main />
        </React.StrictMode>
    )
}
