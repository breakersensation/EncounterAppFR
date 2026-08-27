import axios from 'axios';

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || '';

export async function getBackgrounds(){
    const response = await axios.get(`${apiBaseUrl}/api/backgrounds`);
    return response.data;
}