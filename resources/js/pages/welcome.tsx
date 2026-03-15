import { FormEventHandler } from 'react';
import { Head, useForm } from '@inertiajs/react';
import HomeLayout from '@/layouts/home-layout';
import { Edition, Discipline, PageProps } from '@/types';
import RaceItemList from '@/components/home/race-item-list';

export default function Welcome({
    auth,
    featured,
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
    const { data, setData, get, processing, errors, reset } = useForm({
        start: start,
        end: end,
        discipline: discipline,
    });
    const onChange = (e: any) => {
        setData(e.target.name, e.target.value);
        console.log(data);
    };
    const submit: FormEventHandler = (e) => {
        e.preventDefault();
        get(route('home', { desde: data.desde, hasta: data.hasta, disciplina: data.disciplina }));
    };
    return (
        <HomeLayout user={auth.user}>
            <Head title="Home" />
            <div className="">
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

                <h3 className="">{search ? 'Buscador' : 'Próximas carreras'}</h3>
                <div className="container-fluid mt-2">
                    <form onSubmit={submit} className="row">
                        <div className="col-md-6 col-12 px-0">
                            <div className="input-group">
                                <div className="form-floating">
                                    <input
                                        type="date"
                                        name="desde"
                                        id="desde"
                                        className="form-control"
                                        value={data.start}
                                        onChange={onChange}
                                        placeholder="Desde"
                                        required
                                    />
                                    <label htmlFor="desde" className="">
                                        Desde
                                    </label>
                                </div>
                                <div className="form-floating">
                                    <input
                                        type="date"
                                        name="hasta"
                                        id="hasta"
                                        className="form-control"
                                        value={data.end}
                                        onChange={onChange}
                                        placeholder="Hasta"
                                        required
                                    />
                                    <label htmlFor="desde" className="">
                                        Hasta
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div className="col-md-6 col-12 px-0">
                            <div className="input-group">
                                <div className="form-floating">
                                    <select name="discipline" id="disciplina" className="form-select" value={data.discipline} onChange={onChange}>
                                        <option value="all">Todas</option>
                                        {disciplines.map((discipline, index) => {
                                            return (
                                                <option value={discipline.id} key={index}>
                                                    {discipline.name}
                                                </option>
                                            );
                                        })}
                                    </select>
                                    <label htmlFor="disciplina" className="pl-1 text-white">
                                        Disciplina
                                    </label>
                                </div>
                                <button type="submit" className="btn btn-outline-secondary">
                                    <i className="fa-solid fa-magnifying-glass py-1"></i> Buscar
                                </button>
                            </div>
                        </div>
                    </form>
                    <ul className="row list-group my-4">
                        {editions.map((edition) => (
                            <RaceItemList edition={edition} key={edition.id} />
                        ))}
                    </ul>
                </div>
            </div>
        </HomeLayout>
    );
}

