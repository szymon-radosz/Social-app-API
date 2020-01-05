interface UsersProps {}

interface UsersState {
    users: any;
    lastPage: number;
    path: string;
    currentPage: number;
    count: number;
    from: number;
    paginatePage: number;
}

export { UsersProps, UsersState };
