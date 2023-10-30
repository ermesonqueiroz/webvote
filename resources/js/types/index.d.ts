export interface User {
    id: number;
    name: string;
    email: string;
    email_verified_at: string;
}

export interface Option {
    id: number;
    description: string;
    votes_amount: number;
}

export type PageProps<T extends Record<string, unknown> = Record<string, unknown>> = T & {
    auth: {
        user: User;
    };
};
