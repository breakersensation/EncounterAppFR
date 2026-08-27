import axios from 'axios';

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || '';

export async function getClasses() {
    const response = await axios.get(`${apiBaseUrl}/api/classes`);
    return response.data;
}