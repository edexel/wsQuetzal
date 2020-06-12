// PARA MÁS VALIDACIONES
// https://react-hook-form.com/get-started#Applyvalidation

/**
 * Created by Joel Valdivia
 * Date 10 Jun 2020
 * Description: Archivo con las validaciones para ReactHookForm
 */
export const userRequired = {
    value: true,
    message: 'El usuario es requerido'
}

export const passwordRequired = {
    value: true,
    message: 'La contraseña es requerido'
}

export const emailRequired = {
    value: true,
    message: 'Correo electrónico es requerido'
}

export const emailPattern = {
    value: /^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$/i,
    message: "El correo no es válido"
}
export const passwordPattern = {
    value: /^(?=.*[\d])(?=.*[A-Z])(?=.*[a-z])(?=.*[!@#$%^&.*])[\w!@#$%^&.*]{8,}$/i,
    message: "La contraseña debe contener mínimo 1 mayúscula, 1 minúscula, 1 número, 8 dígitos, 1 caracter especial: !@#$%^&.*"
}