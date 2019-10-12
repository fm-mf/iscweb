import axios from 'axios';

export const getExchangeStudent = (email, esn) =>
  axios
    .post('/api/events/getExchangeStudent', { email, esn })
    .then(res => res.data);

export const getBuddy = (email, password) =>
  axios.post('/api/events/getBuddy', { email, password }).then(res => res.data);
