import type { ChangeEvent } from 'react';
import { Head, useForm } from '@inertiajs/react';
import HomeLayout from '@/layouts/home-layout';
import { Edition, Discipline, PageProps } from '@/types';
import RaceItemList from '@/components/home/race-item-list';

export default function Welcome({
    auth,
    search,
    start,
    end,
    discipline,
    disciplines,
    editions,
}: PageProps<{
    featured: boolean;
    search: boolean;
    start: string;
    end: string;
    discipline: string;
    disciplines: Discipline[];
    editions: Edition[];
}>) {
    const { data, setData, get, processing } = useForm({
        start,
        end,
        discipline,
    });
    const onChange = (e: ChangeEvent<HTMLInputElement | HTMLSelectElement>) => {
        const field = e.target.name as keyof typeof data;
        setData(field, e.target.value);
    };
    const submit = () => {
        get(route('home', { start: data.start, end: data.end, discipline: data.discipline }));
    };
    return (
        <HomeLayout user={auth.user}>
            <Head title="Home" />
            <section>
                {/*featured && <div>
                    <h3 className="text-xl font-semibold text-white">Carreras destacadas</h3>
                    <div>
                        <h4 className="text-lg font-semibold text-white">Enero</h4>
                        <p className="mt-1 max-w-2xl text-sm leading-6 text-gray-500">Personal details and application.</p>
                        <ul role="list" className="divide-y divide-gray-100 text-gray-500">
                            <li className="flex justify-between gap-x-6 py-5">
                                <div className="flex min-w-0 gap-x-4">
                                    <img className="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""/>
                                    <div className="min-w-0 flex-auto">
                                        <p className="text-sm font-semibold leading-6">Nombre Carrera</p>
                                        <p className="mt-1 truncate text-xs leading-5">21km - 42km - 70km</p>
                                    </div>
                                </div>
                                <div className="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p className="text-sm leading-6">21 - 23</p>
                                    <p className="mt-1 text-xs leading-5">Trail-Runnig</p>
                                </div>
                            </li>
                            <li className="flex justify-between gap-x-6 py-5">
                                <div className="flex min-w-0 gap-x-4">
                                    <img className="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""/>
                                    <div className="min-w-0 flex-auto">
                                        <p className="text-sm font-semibold leading-6">Nombre Carrera</p>
                                        <p className="mt-1 truncate text-xs leading-5">21km - 42km - 70km</p>
                                    </div>
                                </div>
                                <div className="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p className="text-sm leading-6">21 - 23</p>
                                    <p className="mt-1 text-xs leading-5">Trail-Runnig</p>
                                </div>
                            </li>
                            <li className="flex justify-between gap-x-6 py-5">
                                <div className="flex min-w-0 gap-x-4">
                                    <img className="h-12 w-12 flex-none rounded-full bg-gray-50" src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80" alt=""/>
                                    <div className="min-w-0 flex-auto">
                                        <p className="text-sm font-semibold leading-6">Nombre Carrera</p>
                                        <p className="mt-1 truncate text-xs leading-5">21km - 42km - 70km</p>
                                    </div>
                                </div>
                                <div className="hidden shrink-0 sm:flex sm:flex-col sm:items-end">
                                    <p className="text-sm leading-6">21 - 23</p>
                                    <p className="mt-1 text-xs leading-5">Trail-Runnig</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>*/}
                <h3 className="text-2xl font-semibold">{search ? 'Buscador' : 'Proximas carreras'}</h3>
                <div className="mt-3">
                    <form
                        onSubmit={(e) => {
                            e.preventDefault();
                            submit();
                        }}
                        className="grid grid-cols-1 gap-3 rounded-lg border bg-card p-4 md:grid-cols-2"
                    >
                        <div className="grid grid-cols-1 gap-3 sm:grid-cols-2">
                            <div className="space-y-1">
                                <label htmlFor="start" className="text-sm font-medium text-muted-foreground">
                                    Desde
                                </label>
                                <input
                                    type="date"
                                    name="start"
                                    id="start"
                                    className="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none ring-offset-background transition focus-visible:ring-2 focus-visible:ring-ring"
                                    value={data.start}
                                    onChange={onChange}
                                    required
                                />
                            </div>
                            <div className="space-y-1">
                                <label htmlFor="end" className="text-sm font-medium text-muted-foreground">
                                    Hasta
                                </label>
                                <input
                                    type="date"
                                    name="end"
                                    id="end"
                                    className="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none ring-offset-background transition focus-visible:ring-2 focus-visible:ring-ring"
                                    value={data.end}
                                    onChange={onChange}
                                    required
                                />
                            </div>
                        </div>
                        <div className="flex items-end gap-3">
                            <div className="w-full space-y-1">
                                <label htmlFor="discipline" className="text-sm font-medium text-muted-foreground">
                                    Disciplina
                                </label>
                                <select
                                    name="discipline"
                                    id="discipline"
                                    className="w-full rounded-md border bg-background px-3 py-2 text-sm outline-none ring-offset-background transition focus-visible:ring-2 focus-visible:ring-ring"
                                    value={data.discipline}
                                    onChange={onChange}
                                >
                                    <option value="all">Todas</option>
                                    {disciplines.map((discipline) => {
                                        return (
                                            <option value={discipline.id} key={discipline.id}>
                                                {discipline.name}
                                            </option>
                                        );
                                    })}
                                </select>
                            </div>
                            <button
                                type="submit"
                                disabled={processing}
                                className="inline-flex h-9 items-center rounded-md border px-4 text-sm font-medium transition-colors hover:bg-accent hover:text-accent-foreground disabled:pointer-events-none disabled:opacity-50"
                            >
                                <i className="fa-solid fa-magnifying-glass mr-2"></i>
                                Buscar
                            </button>
                        </div>
                    </form>
                    <ul className="mt-4 space-y-3">
                        {editions.map((edition) => (
                            <RaceItemList edition={edition} key={edition.id} />
                        ))}
                    </ul>
                </div>
            </section>
        </HomeLayout>
    );
}

