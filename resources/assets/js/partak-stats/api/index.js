import axios from 'axios';

const CACHE = {};
const BASE = '/partak/stats/api';
const semesterUrl = (semester, url) => `${BASE}/semester/${semester}/${url}`;

export const cached = callback =>
  new Promise((resolve, reject) => {
    const key = callback.__key;
    if (CACHE[key] !== undefined) {
      resolve(CACHE[key]);
    } else {
      callback()
        .then(result => {
          CACHE[key] = result;
          resolve(result);
        })
        .catch(e => reject(e));
    }
  });

const get = url => {
  const cb = () => axios.get(url).then(res => res.data);
  cb.__key = url;
  return cb;
};

export const getStudentCounts = semester =>
  get(semesterUrl(semester, 'student-counts'));

export const getArrivals = semester => get(semesterUrl(semester, 'arrivals'));

export const getStudents = semester => get(semesterUrl(semester, 'students'));

export const getBuddies = semester => get(semesterUrl(semester, 'buddies'));

export const getActiveBuddies = () => get(`${BASE}/active-buddies`);

export const getSemesters = () => get(`${BASE}/semesters`);
