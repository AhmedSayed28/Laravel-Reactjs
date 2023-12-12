import "./App.css";
import * as React from "react";
import { BrowserRouter as Router, Route, Routes, Link } from "react-router-dom";
import "bootstrap/dist/css/bootstrap.min.css";
import CreateProduct from "./components/products/create.component";
import EditProduct from "./components/products/edit.component";
import ProductList from "./components/products/productList.component";
function App() {
  return (
    <div className='App'>
      <header className='App-header'>
        <Router>
          <nav className='navbar navbar-expand-lg '>
            <div className='container-fluid '>
              <Link className='navbar-brand text-light' to={"/"}>
                API
              </Link>
              <button
                className='navbar-toggler'
                type='button'
                data-bs-toggle='collapse'
                data-bs-target='#navbarNav'
                aria-controls='navbarNav'
                aria-expanded='false'
                aria-label='Toggle navigation'
              >
                <span className='navbar-toggler-icon'></span>
              </button>
              <div className='collapse navbar-collapse' id='navbarNav'>
                <ul className='navbar-nav text-light'>
                  <li className='nav-item '>
                    <Link
                      className='nav-link text-light active'
                      aria-current='page'
                      to='/products'
                    >
                      Products
                    </Link>
                  </li>
                  <li className='nav-item'>
                    <Link className='nav-link text-light' to='/products/create'>
                      Create
                    </Link>
                  </li>
                </ul>
              </div>
            </div>
          </nav>
          <Routes>
            <Route path='/products' element={<ProductList />} />
            <Route path='/products/create' element={<CreateProduct />} />
            <Route path='/products/edit/:id' element={<EditProduct />} />
          </Routes>
        </Router>
      </header>
    </div>
  );
}

export default App;
