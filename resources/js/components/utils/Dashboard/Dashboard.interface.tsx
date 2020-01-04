interface DashboardProps {
    routes: any;
}

interface DashboardState {
    redirectLogin: boolean;
    usersCount: number;
    productsCount: number;
    ForumPostsCount: number;
    ForumCommentsCount: number;
}

export { DashboardProps, DashboardState };
