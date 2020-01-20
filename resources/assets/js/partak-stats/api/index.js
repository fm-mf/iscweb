import axios from 'axios';

const BASE = '/partak/stats/api';
const semesterUrl = (semester, url) => `${BASE}/semester/${semester}/${url}`;

export const getStudentCounts = semester =>
  axios.get(semesterUrl(semester, 'student-counts')).then(res => res.data);

export const getArrivals = semester =>
  axios.get(semesterUrl(semester, 'arrivals')).then(res => res.data);

export const getBuddies = semester =>
  axios.get(semesterUrl(semester, 'buddies')).then(res => res.data);

export const getActiveBuddies = semester =>
  axios.get(semesterUrl(semester, 'active-buddies')).then(res => res.data);
