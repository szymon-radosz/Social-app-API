interface DashboardProps {
    routes: any;
}

interface DashboardState {
    redirectLogin: boolean;
    usersCount: number;
    ForumPostsCount: number;
    ForumCommentsCount: number;
}

export { DashboardProps, DashboardState };
