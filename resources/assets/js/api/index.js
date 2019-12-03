import axios from 'axios';

export const getExchangeStudent = (event, email, esn) =>
  axios
    .post('/api/events/getExchangeStudent', { event, email, esn })
    .then(res => res.data);

export const getBuddy = (event, email, password) =>
  axios
    .post('/api/events/getBuddy', { event, email, password })
    .then(res => res.data);

export const saveResponse = (
  event,
  id_user,
  diet,
  medical_issues,
  notes,
  custom
) =>
  axios.post('/api/events/reserve', {
    event,
    id_user,
    diet,
    medical_issues,
    notes,
    custom
  });
