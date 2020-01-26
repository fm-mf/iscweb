import axios from 'axios';

const CACHE = {};
const BASE = '/partak/stats/api';
const semesterUrl = (semester, url) => `${BASE}/semester/${semester}/${url}`;
const errorListeners = [];

export const addErrorListener = listener => {
  errorListeners.push(listener);
};

export const removeErrorListener = listener => {
  const index = errorListeners.indexOf(listener);
  if (index >= 0) {
    errorListeners.splice(index, 1);
  }
};

const emitError = error => {
  errorListeners.forEach(listener => listener(error));
};

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

export const promised = (promise, store = true) => {
  const result = {
    data: null,
    error: null,
    loading: true
  };

  promise.then(
    res => {
      if (store) {
        result.data = res;
      }
      result.loading = false;
    },
    e => {
      result.error = e;
      result.loading = false;
    }
  );

  result.then = cb => {
    promise.then(cb);
    return result;
  };

  return result;
};

export const emptyPromised = () => ({
  data: null,
  loading: false,
  error: null
});

const get = url => {
  const cb = () =>
    axios
      .get(url)
      .then(res => res.data)
      .catch(e => emitError(e));
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
