import { LucideIcon } from 'lucide-react';
import type { Config } from 'ziggy-js';

export interface Auth {
    user: User;
}

export interface BreadcrumbItem {
    title: string;
    href: string;
}

export interface NavGroup {
    title: string;
    items: NavItem[];
}

export interface NavItem {
    title: string;
    href: string;
    icon?: LucideIcon | null;
    isActive?: boolean;
}

export interface SharedData {
    name: string;
    quote: { message: string; author: string };
    auth: Auth;
    ziggy: Config & { location: string };
    sidebarOpen: boolean;
    [key: string]: unknown;
}

export interface User {
    id: number;
    name: string;
    email: string;
    avatar?: string;
    email_verified_at: string | null;
    created_at: string;
    updated_at: string;
    [key: string]: unknown; // This allows for additional properties...
}

export interface Edition {
    id: number;
    start_date: string;
    end_date: string;
    distances: string[];
    image: string;
    race: Race;
}

export interface Race {
    id: number;
    name: string;
    slug: string;
    description: string;
    image: string;
    final_place: string;
    place?: string;
    discipline: Discipline;
    places?: Place[];
    links?: Link[];
}

export interface Discipline {
    id: number;
    name: string;
    description: string;
}

export interface Province {
    id: number;
    name: string;
}

export interface Locality {
    id: number;
    name: string;
}

export interface Place {
    id: number;
    province: Province;
    locality?: Locality;
    place?: string;
}

export interface Link {
    id: number;
    type: string;
    title: string;
    url: string;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
