import { AxiosResponse } from "axios";

type Buddy = {
  first_name: string
  last_name: string
  exchange_students_count: number
}

type StudentCounts = {
  arriving_students: number
  students_with_profile: number
  students_with_arrival: number
  students_with_buddy: number
  students_from_previous: number
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

declare function getStudentCounts(semester: string): Promise<StudentCounts>;
declare function getArrivals(semester: string): Promise<Arrivals>;
declare function getBuddies(semester: string): Promise<Buddy[]>;
declare function getActiveBuddies(semester: string): Promise<Buddy[]>;