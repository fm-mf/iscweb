/* eslint-disable @typescript-eslint/camelcase */
import axios from 'axios';

export const getExchangeStudent = (event, email, esn) =>
  axios
    .post('/api/events/getExchangeStudent', { event, email, esn })
    .then(res => res.data);

export const getBuddy = (event, email, password) =>
  axios
    .post('/api/events/getBuddy', { event, email, password })
    .then(res => res.data);

export const createReservation = (event, id_user) =>
  axios.post('/api/events/reservation', {
    event,
    id_user
  });

export const confirmReservation = (
  event,
  id_user,
  diet,
  medical_issues,
  notes,
  custom
) =>
  axios.put('/api/events/reservation', {
    event,
    id_user,
    diet,
    medical_issues,
    notes,
    custom
  });

export const cancelReservation = hash =>
  axios.delete(`/api/events/reservation/${hash}`);

export const getOwTrips = () =>
  axios.get('/api/ow-trips').then(res => res.data);
