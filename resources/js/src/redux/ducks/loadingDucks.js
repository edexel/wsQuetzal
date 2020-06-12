
/**
 * Created by Joel Valdivia
 * Date 10 Jun 2020
 * Reductor Ducks sobre el Loading Global de la App
 */

import { bindActionCreators } from "redux";

// BEGIN Constantes
export const LOADING_SHOW = 'LOADING_SHOW';
export const LOADING_HIDE = 'LOADING_HIDE';
// END Constantes

// END Reducer

/**
 * Reducer de alerta para detectar el cambio de una parte
 * del estado de la app (en este caso alerta) y realizar 
 * el cambio dependiendo de la accion
 * 
 * @param {*} state estado actual de la app
 * @param {*} action accion a tomar el reducer
 */
export default function loadingReducer(state = { show: false, text: '' }, action) {

    // verifica que cambiará dependiendo el tipo de accion    
    switch (action.type) {
        case LOADING_SHOW:
            return { show: true, text: action.payload }
        case LOADING_HIDE:
            // regresa el objeto del estado con el nuevo objeto
            return { show: false, text: '' }
        default:
            // regresa el estado actual
            return state;
    }

}
// END Reducer

// BEGIN Acciones
export const loadingShow = (text) => { return { type: LOADING_SHOW, payload: text } }
export const loadingHide = () => { return { type: LOADING_HIDE } }
// END Acciones