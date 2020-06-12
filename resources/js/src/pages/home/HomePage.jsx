import React from 'react';
import { Link } from 'react-router-dom';
import { useSelector, useDispatch } from 'react-redux';

/**
 * Created by Joel Valdivia
 * Date 05 Jun 2020
 * Description: Componente de Home de la Web App
 */
function HomePage() {

    // obtiene usuario del store
    const { user } = useSelector(store => store.authenticate);
    console.log('sientra a home')
    return (
        <div className="col-lg-8 offset-lg-2">
            <h1>Bienvenido {user.username}!</h1>
            <p>Haz entrado al consultorio de Laura!!</p>
        </div>
    );
}

export { HomePage };