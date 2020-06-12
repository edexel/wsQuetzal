import { loginRequest, loginSuccess, loginFailure } from "../redux/ducks/loginDucks";
import { HttpService } from "../services/HttpService";
import { modalError, modalSuccess } from "../redux/ducks/modalDucks";
import { loadingHide } from "../redux/ducks/loadingDucks";
import { forgotRequest, forgotSuccess, forgotFailure } from "../redux/ducks/forgotDucks";

/**
 * Created by Joel Valdivia
 * Date 09 Jun 2020
 * 
 * Funcion para realizar una peticion http POST y obtener token
 * @param {Object} dispatch funcion que dispara acciones de Redux
 */
const login = async (dispatch, history, credentials) => {

  // dispara accion para saber que se realiza una peticion HTTP
  dispatch(loginRequest(credentials.username));

  try {
    // realiza petición Http
    const loginResponseData = await HttpService('/auth/login', 'POST', credentials);

    // agrega la informacion a local storage
    localStorage.setItem('user', JSON.stringify(loginResponseData.data));

    // dispara los datos al store de redux
    dispatch(loginSuccess(loginResponseData));
    dispatch(loadingHide())
    // redirije al inicio
    history.push('/');

  } catch (error) {
    dispatch(loadingHide())
    // dispara el error
    dispatch(loginFailure(error));
    // muestra modal con error
    dispatch(modalError({ title: 'Error al iniciar sesión', body: error }));

  }
}

/**
 * funcion para eliminar la sesion en localstorage
 */
const logout = () => localStorage.clear();

/**
* Created by Joel Valdivia
* Date 09 Jun 2020
* 
* Funcion para realizar una peticion http POST y obtener token
* @param {Object} dispatch funcion que dispara acciones de Redux
*/
const forgot = async (dispatch, history, username) => {

  // dispara accion para saber que se realiza una peticion HTTP
  dispatch(forgotRequest(username));

  try {
    // realiza petición Http
    const forgotResponseData = await HttpService('/auth/forgot', 'POST', username);

    // dispara los datos al store de redux
    dispatch(forgotSuccess(forgotResponseData.message));
    dispatch(loadingHide())
    dispatch(modalSuccess({ title: 'Solicitud para restablecer contraseña', body: forgotResponseData.message }));
    // redirije al inicio
    // history.push('/login');

  } catch (error) {
    dispatch(loadingHide())
    // dispara el error
    dispatch(forgotFailure(error));
    // muestra modal con error
    dispatch(modalError({ title: 'Error al restablecer contraseña', body: error }));

  }
}



/**
 * Exporta Objeto con las funciones del servicio de Auth
 */
// export const AuthActions = {
//   login,
//   logout,
//   forgot
// }