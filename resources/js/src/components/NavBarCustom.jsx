/**
 * Created by Joel Valdivia
 * Date 11 Jun 2020
 * Description: NavBar
 */

import React from "react";
import { useSelector } from "react-redux";
import { Navbar, Nav } from "react-bootstrap";
import { Link } from "react-router-dom";

function NavBarCustom({ classCss}) {

    const { isAuth } = useSelector(store => store.authenticate);

    return (
        <Navbar className={`nav-bottom-border ${classCss}`} bg="light" variant='light' expand="lg">
            {/* <Navbar.Brand href='https://klori.com.mx' target='_blank' >Klori</Navbar.Brand> */}
            <Link to="/">
                {/* <img className="logo-white" src='/images/logo/logo_simbolo.png' alt="Logo" /> */}
                {/* <i className="fa fa-fw fa-home"  /> */}
                <i class="fas fa-fire"></i>

            </Link>
            {
                isAuth &&
                <Nav className="container-fluid-nav text-center">
                    <Nav.Link>Consultorio Laura</Nav.Link>
                </Nav>
            }
            <Navbar.Toggle aria-controls="responsive-navbar-nav" />
            <Navbar.Collapse className="justify-content-end">
                {
                    isAuth &&
                    <Nav>
                        <Nav.Link href="/login"><b>Salir</b></Nav.Link>
                    </Nav>
                }
            </Navbar.Collapse>

        </Navbar>
    )
}

export default NavBarCustom;