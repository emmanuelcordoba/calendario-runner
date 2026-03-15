import { PropsWithChildren } from 'react';
import { Link } from '@inertiajs/react';
import { User } from '@/types';

export default function Home({ user, children }: PropsWithChildren<{ user: User }>) {
    return (
        <div className="flex min-h-screen flex-col">
            <div className="p-4 text-right text-sm">
                {user ? (
                    <a
                        href={route('dashboard')}
                        className="text-foreground/80 transition-colors hover:text-foreground"
                    >
                        Dashboard
                    </a>
                ) : (
                    <>
                        <Link
                            href={route('login')}
                            className="text-foreground/80 transition-colors hover:text-foreground"
                        >
                            Iniciar sesión
                        </Link>
                        {/*
                            <Link
                                href={route('register')}
                                className="link-underline link-underline-opacity-0"
                            >
                                Registro
                            </Link>
                            */}
                    </>
                )}
            </div>
            <main className="mx-auto w-full max-w-5xl flex-1 px-4 pb-8">
                <div className="text-center">
                    <Link href={route('home')} className="inline-block text-3xl font-bold tracking-tight transition-opacity hover:opacity-80">
                        Calendario Runner
                    </Link>
                    <p className="mt-2 text-lg text-muted-foreground">Agenda argentina de carreras de calle y montaña.</p>
                </div>
                <div className="mx-auto mt-6 w-full max-w-3xl">{children}</div>
                <div className="mt-8 text-center">
                    <a href="https://cafecito.app/emmanuelcordoba" rel="noopener" target="_blank" className="inline-block">
                        <img
                            srcSet="https://cdn.cafecito.app/imgs/buttons/button_1.png 1x, https://cdn.cafecito.app/imgs/buttons/button_1_2x.png 2x, https://cdn.cafecito.app/imgs/buttons/button_1_3.75x.png 3.75x"
                            src="https://cdn.cafecito.app/imgs/buttons/button_1.png"
                            alt="Invitame un cafe en cafecito.app"
                        />
                    </a>
                </div>
            </main>
            <div className="mt-4 pb-6 text-center text-sm">
                <a
                    href="https://emmanuelcordoba.com/"
                    className="text-foreground/80 transition-colors hover:text-foreground"
                    target="_blank"
                    rel="noopener"
                >
                    <i className="fa-brands fa-linkedin mr-2"></i>
                    Desarrollado por Emmanuel Cordoba
                </a>
            </div>
        </div>
    );
}
