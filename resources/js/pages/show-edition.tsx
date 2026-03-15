import { Head } from '@inertiajs/react';
import { Edition, PageProps } from '@/types';
import HomeLayout from '@/layouts/home-layout';
import moment from 'moment';

export default function ShowEdition({ auth, edition }: PageProps<{ edition: Edition }>) {
    const imageUrl = edition.image || edition.race.image || '/images/logo.png';

    return (
        <HomeLayout user={auth.user}>
            <Head title="Carrera" />
            <article className="mb-4 rounded-lg border bg-card p-5">
                <h2 className="text-2xl font-semibold tracking-tight">{edition.race.name}</h2>
                <div className="mt-4 grid grid-cols-1 gap-5 md:grid-cols-12">
                    <div className="md:col-span-8 lg:col-span-9">
                        <p className="text-sm leading-6 text-muted-foreground">{edition.race.description}</p>
                        <dl className="mt-4 space-y-3">
                            <div>
                                <dt className="text-sm font-medium">Fecha</dt>
                                <dd className="mt-1 text-sm text-muted-foreground">
                                    {moment(edition.start_date, 'YYYY-MM-DD').format('D/M ')} al{' '}
                                    {moment(edition.end_date, 'YYYY-MM-DD').format('D/M ')} del{' '}
                                    {moment(edition.start_date, 'YYYY-MM-DD').format('YYYY ')}
                                </dd>
                            </div>
                            <div>
                                <dt className="text-sm font-medium">Lugar</dt>
                                <dd className="mt-1 text-sm text-muted-foreground">{edition.race.final_place}</dd>
                            </div>
                            <div>
                                <dt className="text-sm font-medium">Disciplina</dt>
                                <dd className="mt-1 text-sm text-muted-foreground">{edition.race.discipline.name}</dd>
                            </div>
                            <div>
                                <dt className="text-sm font-medium">Distancias</dt>
                                <dd className="mt-1 text-sm text-muted-foreground">{edition.distances.join(' - ')}</dd>
                            </div>
                            <div>
                                <dt className="text-sm font-medium">Enlaces</dt>
                                <dd className="mt-2 flex flex-wrap gap-2">
                                    {edition.race.links?.map((link) => (
                                        <a
                                            href={link.url}
                                            key={link.id}
                                            target="_blank"
                                            rel="noopener"
                                            className="inline-flex rounded-md border px-3 py-1 text-sm transition-colors hover:bg-accent hover:text-accent-foreground"
                                        >
                                            {link.type}
                                        </a>
                                    ))}
                                </dd>
                            </div>
                        </dl>
                    </div>
                    <div className="md:col-span-4 lg:col-span-3">
                        <div className="overflow-hidden rounded-lg border bg-background">
                            <img src={imageUrl} className="h-auto w-full object-cover" alt="Logo de Imagen" />
                        </div>
                    </div>
                </div>
                <button
                    type="button"
                    onClick={() => history.back()}
                    className="mt-4 inline-flex items-center rounded-md border px-4 py-2 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground"
                >
                        Volver
                </button>
            </article>
        </HomeLayout>
    );
}
