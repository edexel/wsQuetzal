/**
 * Created by Joel Valdivia
 * Date 05 Jun 2020
 * Description: Archivo para componetes sobre la pagina de Login
 */
import React, { useEffect } from 'react';
import { useDispatch, useSelector } from 'react-redux';
import { LoginForm } from "./LoginForm";
import { logout } from '../../redux/ducks/loginDucks';
import { loadingShow } from '../../redux/ducks/loadingDucks';
import { Link } from 'react-router-dom';
import { loginAction } from "../../actions/auth";
import { Alert } from "react-bootstrap";

/**
 * Componente que renderiza la Pagina de Login
 * @param {Object} history Propiedad encargada del historial del navegador 
 */
function LoginPage({ history }) {
    // disparador de acciones de redux
    const dispatch = useDispatch();
    const { recover } = useSelector(store => store)
    
    // Funciona como constructor
    useEffect(() => {
        console.log('entra a login')
        // dispara la accion de cerrar sesion al entrar al componente
        dispatch(logout());
    }, []);

    // envía la informacion hacia el servidor para realizar una autenticacion
    const onSubmit = data => {
        // muestra loading
        dispatch(loadingShow('Entrando al consultorio...'))
        // dispara la accion de la peticion Login
        loginAction(dispatch, history, data)


    }

    return (
        <div className="col-lg-6 offset-lg-3 container-login">
            <h3 >Entra al sistema Quetzal de</h3>
            <h2 >Klori</h2>
            <p >quetzal.klori.com.mx</p>
            <p>Escribe tu nombre de <b>usuario</b> y <b>contraseña</b>.</p>

            {
                recover ?
                    recover.message && <Alert variant='success'>{recover.message}</Alert>
                    : null
            }
            {/* Componente de Formulario de Login */}
            <LoginForm onSubmit={onSubmit} />
            <Link to='/forgot'>¿Olvidaste la contraseña?</Link>
        </div>
    );
}

export { LoginPage };