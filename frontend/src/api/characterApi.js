import axios from 'axios';

const apiBaseUrl = import.meta.env.VITE_API_BASE_URL || '';

export async function createCharacter(character){
    const response = await axios.post(`${apiBaseUrl}/api/characters`, character);
    
    return response.data;
}

export async function getCharacter(id){
    const response = await axios.get(`${apiBaseUrl}/api/characters/${id}`);

    return response.data;
}

export async function updateCharacter(id, character){
    const response = await axios.patch(`${apiBaseUrl}/api/characters/${id}`, character);

    return response.data;
}