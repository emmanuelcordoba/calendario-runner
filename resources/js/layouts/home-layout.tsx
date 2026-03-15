import { PropsWithChildren } from 'react';
import { Link } from '@inertiajs/react';
import { User } from '@/types';

export default function Home({ user, children }: PropsWithChildren<{ user: User }>) {
    return (
        <div className='d-flex flex-column'>
            <div className="p-4 text-end">
                {user ? (
                    <a
                        href={route('dashboard')}
                        className="link-underline link-underline-opacity-0"
                    >
                        Dashboard
                    </a>
                ) : (
                    <>
                        <Link
                            href={route('login')}
                            className="link-underline link-underline-opacity-0"
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
            <main className="container">
                <div className="row">
                    <div className="col text-center">
                        <Link
                            href={route('home')}
                            className="link-underline link-underline-opacity-0"
                        ><h1>Calendario Runner</h1></Link>
                        <p className="text-xl text-gray-600">Agenda argentina de carreras de calle y montaña.</p>
                    </div>
                </div>
                <div className="row">
                    <div className="col col-sm-10 col-md-8 mx-auto">
                        {children}
                    </div>
                </div>
                <div className="row">
                    <div className="col text-center">
                        <a href='https://cafecito.app/emmanuelcordoba' rel='noopener' target='_blank'><img
                            srcSet='https://cdn.cafecito.app/imgs/buttons/button_1.png 1x, https://cdn.cafecito.app/imgs/buttons/button_1_2x.png 2x, https://cdn.cafecito.app/imgs/buttons/button_1_3.75x.png 3.75x'
                            src='https://cdn.cafecito.app/imgs/buttons/button_1.png'
                            alt='Invitame un café en cafecito.app'/></a>
                    </div>
                </div>
            </main>
            <div className="d-grid mt-4">
                <div className="text-center">
                    <a
                        href="https://emmanuelcordoba.com/"
                        className="link-underline link-underline-opacity-0"
                        target='_blank'
                    >
                        <i className="fa-brands fa-linkedin me-2"></i>
                        Desarrollado por Emmanuel Cordoba
                    </a>
                </div>
            </div>
        </div>
    );
}
