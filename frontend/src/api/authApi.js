import axios from 'axios';

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || '';

export async function login(email, password) {
    const response = await axios.post(
        `${apiBaseUrl}/api/auth/login`,
        {
            email,
            password,
        }
    );

    return response.data;
}