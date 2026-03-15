import { PropsWithChildren } from 'react';
import { Link } from '@inertiajs/react';
import { User } from '@/types';
import { useAppearance } from '@/hooks/use-appearance';
import { Moon, Sun } from 'lucide-react';

export default function Home({ user, children }: PropsWithChildren<{ user: User }>) {
    const { appearance, updateAppearance } = useAppearance();

    return (
        <div className="flex min-h-screen flex-col">
            <div className="flex items-center justify-end gap-3 p-4 text-sm">
                {/* Theme switch */}
                <div className="flex items-center rounded-md border">
                    <button
                        type="button"
                        onClick={() => updateAppearance('light')}
                        aria-label="Tema claro"
                        className={`flex items-center gap-1 rounded-l-md px-3 py-1.5 text-sm transition-colors ${
                            appearance === 'light'
                                ? 'bg-foreground text-background'
                                : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground'
                        }`}
                    >
                        <Sun className="h-4 w-4" />
                    </button>
                    <button
                        type="button"
                        onClick={() => updateAppearance('dark')}
                        aria-label="Tema oscuro"
                        className={`flex items-center gap-1 rounded-r-md px-3 py-1.5 text-sm transition-colors ${
                            appearance === 'dark'
                                ? 'bg-foreground text-background'
                                : 'text-muted-foreground hover:bg-accent hover:text-accent-foreground'
                        }`}
                    >
                        <Moon className="h-4 w-4" />
                    </button>
                </div>
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
