import axios from 'axios';

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || '';

export async function getSpecies() {
    const response = await axios.get(`${apiBaseUrl}/api/species`);
    return response.data;
}