import { AxiosResponse } from "axios";

type Request<T> = () => Promise<T> & { __key: string }

type Buddy = {
  id_user: number
  first_name: string
  last_name: string
  partak: boolean
  exchange_students_count: number
}

type Faculty = {
  faculty: string
  count: number
}

type Buddies = {
  list: Buddy[]
  by_faculty: Faculty[]
}

type StudentCounts = {
  arriving_students: number
  students_with_profile: number
  students_with_arrival: number
  students_with_buddy: number
  students_from_previous: number
  students_with_esncard: number
  total_buddies: number
  active_buddies: number
}

type Students = {
  by_faculty: Faculty[]
  by_gender: { sex: string; count: number }[]
  by_accommodation: { full_name: string; count: number}[]
  with_accommodation: number
  with_facebook: number
  with_whatsapp: number
  with_about: number
  with_photo: number
}

type Arrivals = {
  dates: {
    arrival: string,
    count: number
  }[],
  transports: {
    transportation: string;
    count: number;
  }[]
}

type Semester = {
  id: string
  name: string
  year: string
  semester: string
}

type Country = {
  id: number
  name: string
  count: number
}

type Promised<T> = {
  data: T | null
  loading: boolean
  error: any
}

/**
 * Caches response, returns cached data on subsequent calls
 */
declare function cached<T>(request: Request<T>): Promise<T>;

/**
 * Returns api loading object, useful to track more loadings at once
 * @param request
 */
declare function promised<T>(request: Promise<T>): Promised<T>;
declare function emptyPromised<T = null>(): Promised<T>;

declare function addErrorListener(listener: (error: any) => void): void;
declare function removeErrorListener(lisener: (error: any) => void): void;

declare function getStudentCounts(semester: string): Request<StudentCounts>;
declare function getArrivals(semester: string): Request<Arrivals>;
declare function getStudents(semester: string, faculty?: string): Request<Students>;
declare function getCountries(semester: string): Request<Country[]>;
declare function getBuddies(semester: string): Request<Buddies>;
declare function getSemesters(): Request<Semester[]>;
